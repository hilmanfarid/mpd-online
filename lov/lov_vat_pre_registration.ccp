<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\lov" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" validateRequest="True" cachingDuration="1 minutes" wizardTheme="sikm" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" name="LOV_REGION" pageSizeLimit="100" wizardCaption="List of P CUSTOMER SEGMENT " wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="TableParameters" parameterTypeListName="ParameterTypeList" resultSetType="parameter" dataSource="SELECT a.*, b.region_name as kota,c.region_name as kec, d.region_name as kel
FROM t_vat_pre_registration a
left join p_region b on a.brand_p_region_id=b.p_region_id
left join p_region c on a.brand_p_region_id_kec=c.p_region_id
left join p_region d on a.brand_p_region_id_kel=d.p_region_id
WHERE ( upper(company_brand) LIKE '%{s_keyword}%'
OR upper(brand_address_name) LIKE '%{s_keyword}%' )">
			<Components>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="company_brand" fieldSource="company_brand" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_REGIONcompany_brand">
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
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="True" name="PILIH" PathID="LOV_REGIONPILIH">
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
				<TextBox id="27" visible="No" fieldSourceType="DBColumn" dataType="Text" name="t_vat_pre_registration_id" PathID="LOV_REGIONt_vat_pre_registration_id" fieldSource="t_vat_pre_registration_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="42" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rt" PathID="LOV_REGIONbrand_address_rt" fieldSource="brand_address_rt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Label id="43" fieldSourceType="DBColumn" dataType="Text" html="False" name="brand_address_no" fieldSource="brand_address_no" wizardCaption="DESCRIPTION" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_REGIONbrand_address_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<TextBox id="44" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_address_rw" PathID="LOV_REGIONbrand_address_rw" fieldSource="brand_address_rw">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<Label id="45" fieldSourceType="DBColumn" dataType="Text" html="False" name="brand_address_name" fieldSource="brand_address_name" wizardCaption="CODE" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="LOV_REGIONbrand_address_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
<TextBox id="46" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_p_region_id" PathID="LOV_REGIONbrand_p_region_id" fieldSource="brand_p_region_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="47" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_p_region_id_kel" PathID="LOV_REGIONbrand_p_region_id_kel" fieldSource="brand_p_region_id_kel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="48" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_p_region_id_kec" PathID="LOV_REGIONbrand_p_region_id_kec" fieldSource="brand_p_region_id_kec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="49" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_phone_no" PathID="LOV_REGIONbrand_phone_no" fieldSource="brand_phone_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="50" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_mobile_no" PathID="LOV_REGIONbrand_mobile_no" fieldSource="brand_mobile_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="51" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_fax_no" PathID="LOV_REGIONbrand_fax_no" fieldSource="brand_fax_no">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="52" visible="No" fieldSourceType="DBColumn" dataType="Text" name="brand_zip_code" PathID="LOV_REGIONbrand_zip_code" fieldSource="brand_zip_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="53" visible="No" fieldSourceType="DBColumn" dataType="Text" name="kota" PathID="LOV_REGIONkota" fieldSource="kota">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="54" visible="No" fieldSourceType="DBColumn" dataType="Text" name="kec" PathID="LOV_REGIONkec" fieldSource="kec">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
<TextBox id="55" visible="No" fieldSourceType="DBColumn" dataType="Text" name="kel" PathID="LOV_REGIONkel" fieldSource="kel">
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
						<Action actionName="Custom Code" actionCategory="General" id="35"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="3" leftBrackets="1"/>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="p_region_level_id" dataType="Float" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="4" rightBrackets="1"/>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="upper(region_name)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="Or" leftBrackets="1" parameterSource="s_keyword"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="s_keyword" rightBrackets="1"/>
			</TableParameters>
			<JoinTables>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters>
			</SPParameters>
			<SQLParameters>
				<SQLParameter id="39" parameterType="Expression" variable="Expr0" dataType="Float" parameterSource="3"/>
<SQLParameter id="40" parameterType="Expression" variable="Expr1" dataType="Float" parameterSource="4"/>
<SQLParameter id="41" parameterType="URL" variable="s_keyword" dataType="Text" parameterSource="s_keyword"/>
</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="LOV" wizardCaption="Search P CUSTOMER SEGMENT " wizardOrientation="Horizontal" wizardFormMethod="post" returnPage="lov_vat_pre_registration.ccp" PathID="LOV" pasteActions="pasteActions" connection="ConnSIKP">
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
		<CodeFile id="Events" language="PHPTemplates" name="lov_vat_pre_registration_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="lov_vat_pre_registration.php" forShow="True" url="lov_vat_pre_registration.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
