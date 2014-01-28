<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="ConnSIKP" dataSource="p_bphtb_legal_doc_type, p_legal_doc_type" activeCollection="TableParameters" name="p_bphtb_legal_doc_type_p" pageSizeLimit="100" wizardCaption="List of P Bphtb Legal Doc Type P ">
			<Components>
				<Label id="954" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_bphtb_legal_doc_type_id" fieldSource="p_bphtb_legal_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="955" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_bphtb_legal_doc_type_p_legal_doc_type_id" fieldSource="p_bphtb_legal_doc_type.p_legal_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="956" fieldSourceType="DBColumn" dataType="Float" html="False" name="npoptkp" fieldSource="npoptkp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="957" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_bphtb_legal_doc_type_description" fieldSource="p_bphtb_legal_doc_type.description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="958" fieldSourceType="DBColumn" dataType="Date" html="False" name="p_bphtb_legal_doc_type_creation_date" fieldSource="p_bphtb_legal_doc_type.creation_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="959" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_bphtb_legal_doc_type_created_by" fieldSource="p_bphtb_legal_doc_type.created_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="960" fieldSourceType="DBColumn" dataType="Date" html="False" name="p_bphtb_legal_doc_type_updated_date" fieldSource="p_bphtb_legal_doc_type.updated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="961" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_bphtb_legal_doc_type_updated_by" fieldSource="p_bphtb_legal_doc_type.updated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="962" fieldSourceType="DBColumn" dataType="Float" html="False" name="p_legal_doc_type_p_legal_doc_type_id" fieldSource="p_legal_doc_type.p_legal_doc_type_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="963" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="964" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_legal_doc_type_description" fieldSource="p_legal_doc_type.description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="965" fieldSourceType="DBColumn" dataType="Date" html="False" name="p_legal_doc_type_creation_date" fieldSource="p_legal_doc_type.creation_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="966" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_legal_doc_type_created_by" fieldSource="p_legal_doc_type.created_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="967" fieldSourceType="DBColumn" dataType="Date" html="False" name="p_legal_doc_type_updated_date" fieldSource="p_legal_doc_type.updated_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="968" fieldSourceType="DBColumn" dataType="Text" html="False" name="p_legal_doc_type_updated_by" fieldSource="p_legal_doc_type.updated_by">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="969" fieldSourceType="DBColumn" dataType="Text" html="False" name="doc_cons" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1p_bphtb_legal_doc_type_pdoc_cons" fieldSource="doc_cons">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="949" conditionType="Expression" useIsNull="False" field="p_bphtb_legal_doc_type.p_bphtb_legal_doc_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" expression="p_bphtb_legal_doc_type.p_legal_doc_type_id =p_legal_doc_type.p_legal_doc_type_id" parameterSource="p_bphtb_legal_doc_type_id"/>
				<TableParameter id="950" conditionType="Parameter" useIsNull="False" field="p_bphtb_legal_doc_type.p_bphtb_legal_doc_type_id" dataType="Float" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="keyword"/>
				<TableParameter id="953" conditionType="Parameter" useIsNull="True" field="p_bphtb_legal_doc_type_id" dataType="Float" logicOperator="And" searchConditionType="Equal" parameterType="URL" parameterSource="keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="946" tableName="p_bphtb_legal_doc_type" schemaName="sikp" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
				<JoinTable id="947" tableName="p_legal_doc_type" schemaName="sikp" posLeft="21" posTop="200" posWidth="155" posHeight="168"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="948" tableLeft="p_bphtb_legal_doc_type" tableRight="p_legal_doc_type" fieldLeft="p_bphtb_legal_doc_type.p_legal_doc_type_id" fieldRight="p_legal_doc_type.p_legal_doc_type_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.php" forShow="True" url="trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
