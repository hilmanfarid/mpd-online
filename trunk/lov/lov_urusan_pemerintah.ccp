<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" name="LOV_URUSAN_PEMERINTAH" pageSizeLimit="100" wizardCaption="List of P CUSTOMER SEGMENT " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="SPParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" dataSource="select p_organization_id, organization_code, organization_name organization_name, description
from p_organization
where length(organization_code) = 4 AND
(upper(organization_code) LIKE '%{s_keyword}%' OR
upper(organization_name) LIKE '%{s_keyword}%')
order by organization_code">
			<Components>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="organization_code" fieldSource="organization_code" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_URUSAN_PEMERINTAHorganization_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="organization_name" fieldSource="organization_name" wizardCaption="SEGMENT NAME" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_URUSAN_PEMERINTAHorganization_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="description" fieldSource="description" wizardCaption="DESCRIPTION" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_URUSAN_PEMERINTAHdescription">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="17" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="PILIH" PathID="LOV_URUSAN_PEMERINTAHPILIH">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="26"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="27" visible="No" fieldSourceType="DBColumn" dataType="Text" name="p_organization_id" PathID="LOV_URUSAN_PEMERINTAHp_organization_id" fieldSource="p_organization_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="33"/>
</Actions>
</Event>
</Events>
			<TableParameters>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="29" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" wizardCaption="Search P CUSTOMER SEGMENT " wizardOrientation="Horizontal" wizardFormMethod="post" returnPage="lov_urusan_pemerintah.ccp" PathID="LOV" pasteActions="pasteActions" connection="ConnSIKP">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="LOVs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="LOVButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="FORM" PathID="LOVFORM">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="OBJ" PathID="LOVOBJ">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="lov_urusan_pemerintah_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="lov_urusan_pemerintah.php" forShow="True" url="lov_urusan_pemerintah.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
