<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0" pasteActions="pasteActions">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="14" connection="ConnSIKP" name="LovGrid" pageSizeLimit="100" wizardCaption="List of P CUSTOMER SEGMENT " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="SQLParameters" dataSource="SELECT 
{FIELD_0} FIELD_0,
{FIELD_1} FIELD_1,
{FIELD_2} FIELD_2
FROM {TABLE}
WHERE 
(UPPER(TRIM({FIELD_1})) LIKE upper(trim('%{s_keyword}%'))
OR UPPER(TRIM({FIELD_2})) LIKE upper(trim('%{s_keyword}%')))
{FIELD_3}" parameterTypeListName="ParameterTypeList">
			<Components>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="FIELD_1" fieldSource="field_1" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LovGridFIELD_1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="FIELD_2" fieldSource="field_2" wizardCaption="SEGMENT NAME" wizardSize="50" wizardMaxLength="64" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LovGridFIELD_2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="17" size="5" type="Centered" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Custom" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardimages="images" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="True" wizardOfText="of" wizardPageSize="False" wizardUsePageScroller="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="PILIH" PathID="LovGridPILIH">
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
				<TextBox id="27" visible="No" fieldSourceType="DBColumn" dataType="Text" name="FIELD_0" PathID="LovGridFIELD_0" fieldSource="field_0">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="Header1" PathID="LovGridHeader1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="Header2" PathID="LovGridHeader2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="37" fieldSourceType="DBColumn" dataType="Text" html="False" name="HEADER_LOV" PathID="LovGridHEADER_LOV">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="47"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="50"/>
					</Actions>
				</Event>
				<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="52"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="CODE" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1" leftBrackets="0" rightBrackets="0" parameterSource="s_keyword"/>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="upper(DESCRIPTION)" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="3" leftBrackets="0" rightBrackets="0" parameterSource="s_keyword"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="29" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
				<SQLParameter id="43" variable="TABLE" parameterType="URL" dataType="Text" parameterSource="TABLE"/>
				<SQLParameter id="44" variable="FIELD_0" parameterType="URL" dataType="Text" parameterSource="FIELD_0"/>
				<SQLParameter id="45" variable="FIELD_1" parameterType="URL" dataType="Text" parameterSource="FIELD_1"/>
				<SQLParameter id="46" variable="FIELD_2" parameterType="URL" dataType="Text" parameterSource="FIELD_2"/>
				<SQLParameter id="51" variable="FIELD_3" parameterType="URL" dataType="Text" parameterSource="FIELD_3"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" returnPage="lov_2_field.ccp" PathID="LOV" connection="ConnSIKP" pasteActions="pasteActions">
			<Components>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" PathID="LOVs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="24" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="FORM" PathID="LOVFORM">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="30" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="OBJ" PathID="LOVOBJ">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Text" name="LABEL1" PathID="LOVLABEL1" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="35" fieldSourceType="DBColumn" dataType="Text" name="LABEL2" PathID="LOVLABEL2" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="38" fieldSourceType="DBColumn" dataType="Text" name="FIELD_0" PathID="LOVFIELD_0" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="39" fieldSourceType="DBColumn" dataType="Text" name="FIELD_1" PathID="LOVFIELD_1" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="40" fieldSourceType="DBColumn" dataType="Text" name="FIELD_2" PathID="LOVFIELD_2" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="41" fieldSourceType="DBColumn" dataType="Text" name="HEADER_PAGE" PathID="LOVHEADER_PAGE" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="42" fieldSourceType="DBColumn" dataType="Text" name="HEADER_LOV" PathID="LOVHEADER_LOV" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="48" fieldSourceType="DBColumn" dataType="Text" name="TABLE" PathID="LOVTABLE" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="49" fieldSourceType="DBColumn" dataType="Text" name="ORDER" PathID="LOVORDER" visible="Yes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" PathID="LOVButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
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
		<CodeFile id="3" language="VB" name="lov_2_field.aspx" forShow="True" url="lov_2_field.aspx" comment="&lt;!--" commentEnd="--&gt;" codePage="windows-1252"/>
		<CodeFile id="1" language="VB" name="lov_2_field.aspx.vb" forShow="False" comment="'" codePage="windows-1252"/>
		<CodeFile id="2" language="VB" name="lov_2_fieldDataProvider.vb" path="..\App_Code\.\lov" forShow="False" comment="'" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="lov_2_field_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="lov_2_field.php" forShow="True" url="lov_2_field.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
